<?php

namespace App\Http\Livewire\Backend\General\Seo;

use Exception;
use Throwable;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\Sitemap\Tags\Url;
use App\Models\Configuration;
use Illuminate\Validation\Rule;
use Spatie\Sitemap\Sitemap as Sitemap2;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Sitemap extends Component
{
    use LivewireAlert;
    public $frequency, $priority;

    public function mount()
    {
        $this->frequencies = [
            'hourly',
            'daily',
            'weekly',
            'monthly',
            'always',
            'never'
        ];
        $this->priority = Configuration::where('attribute', 'sitemap_priority')->first()->value;
        $this->frequency = Configuration::where('attribute', 'sitemap_frequency')->first()->value;
    }

    public function render()
    {
        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.general.seo.sitemap');
    }

    public function rules()
    {
        return [
            'frequency' => [
                'required',
                Rule::in($this->frequencies)
            ],
            'priority' => 'required|in:0,1'
        ];
    }

    public function update_sitemap()
    {
        $this->validate();

        try {
            Configuration::where('attribute', 'sitemap_frequency')
                ->update(['value' => $this->frequency]);
            Configuration::where('attribute', 'sitemap_priority')
                ->update(['value' => $this->priority]);

            if ($this->frequency == 'hourly')
                $url_set = Url::CHANGE_FREQUENCY_HOURLY;
            elseif ($this->frequency == 'daily')
                $url_set = Url::CHANGE_FREQUENCY_DAILY;
            elseif ($this->frequency == 'monthly')
                $url_set = Url::CHANGE_FREQUENCY_MONTHLY;
            elseif ($this->frequency == 'yearly')
                $url_set = Url::CHANGE_FREQUENCY_YEARLY;
            elseif ($this->frequency == 'always')
                $url_set = Url::CHANGE_FREQUENCY_ALWAYS;
            elseif ($this->frequency == 'never')
                $url_set = Url::CHANGE_FREQUENCY_NEVER;

            $app_name = Configuration::where('attribute', 'app_name')
                ->first()->value;
            $ads = Configuration::where('attribute', 'app_ads')
                ->first()->value ?? asset('branding-images/ads.png');

            $sitemap = collect([
                [
                    'url' => '/',
                    'image' => $ads,
                    'name' => __('Home')
                ],
                [
                    'url' => '/company',
                    'image' => $ads,
                    'name' => __('Companies')
                ],
                [
                    'url' => '/organization',
                    'image' => $ads,
                    'name' => __('Organizations')
                ],
                [
                    'url' => '/experience',
                    'image' => $ads,
                    'name' => __('Experiences')
                ],
                [
                    'url' => '/social',
                    'image' => $ads,
                    'name' => __('Socials')
                ],
                [
                    'url' => '/blog',
                    'image' => $ads,
                    'name' => __('Blogs')
                ]
            ]);

            if ($this->priority == 1)
                $sitemap = $sitemap->map(function ($item, $idx) {
                    return [
                        ...$item,
                        'priority' => (0.1 * ($idx + 1))
                    ];
                });

            $create_sitemap = Sitemap2::create();
            foreach ($sitemap as $set) {
                if (isset($set['priority']))
                    $create_sitemap = $create_sitemap->add(
                        Url::create($set['url'])
                            ->addImage($set['image'], $set['name'] . ' | ' . $app_name)
                            ->setLastModificationDate(Carbon::now())
                            ->setChangeFrequency($url_set)
                            ->setPriority($set['priority'])
                    );
                else
                    $create_sitemap = $create_sitemap->add(
                        Url::create($set['url'])
                            ->addImage($set['image'], $set['name'] . ' | ' . $app_name)
                            ->setLastModificationDate(Carbon::now())
                            ->setChangeFrequency($url_set)
                    );
            }
            $create_sitemap = $create_sitemap->writeToFile(public_path('sitemap.xml'));

            $this->alert('success', __('Successfully!'), ['text' => __("The sitemap was successfully updated.")]);
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
