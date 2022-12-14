<?php

namespace App\Http\Livewire\Backend\General\Seo;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Configuration;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Keyword extends Component
{
    use LivewireAlert;

    public $keyword;
    protected $listeners = ['confirmed'];

    public function render()
    {
        $value = Configuration::where('attribute', 'keywords')
            ->first()
            ->value;

        $keywords = $value ? Str::of($value)->explode(',') : [];

        return view('livewire.backend.general.seo.keyword', [
            'keywords' => $keywords
        ]);
    }

    public function rules()
    {
        return [
            'keyword' => 'required|max:30|string'
        ];
    }

    public function validationAttributes()
    {
        return [
            'keyword' => __('Keyword')
        ];
    }

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function store_keyword()
    {
        $this->validate();

        $config = Configuration::where('attribute', 'keywords')
            ->first();

        $keywords = Str::of($config->value)
            ->explode(',')
            ->filter(function ($item) {
                return $item != null;
            })
            ->push($this->keyword)
            ->implode(',');

        $config->update(['value' => $keywords]);
        $this->reset();

        $this->alert(
            'success',
            __('Successfully!'),
            ['text' => __('The keywords were successfully updated.')]
        );
    }

    public function delete_keyword($keyword)
    {
        $config = Configuration::where('attribute', 'keywords')
            ->first();

        $keywords = Str::of($config->value)
            ->explode(',')
            ->filter(function ($item) use ($keyword) {
                return $item !== null && $item !== $keyword;
            })
            ->implode(',');

        if ($keywords != '')
            $config->update(['value' => $keywords]);
        else
            $config->update(['value' => null]);

        $this->alert(
            'success',
            __('Successfully!'),
            ['text' => __('The keyword were successfully deleted.')]
        );
    }
}
