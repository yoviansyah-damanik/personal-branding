<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\User;
use App\Models\Sector;
use App\Models\Social;
use App\Models\Company;
use App\Models\Contact;
use App\Models\History;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Visitor;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        $blogs = Blog::get();
        $tags = Tag::get();
        $categories = Category::get();

        $companies = Company::get();
        $sectors = Sector::get();
        $projects = Project::get();

        $experiences = Experience::get();
        $organizations = Organization::get();
        $socials = Social::get();
        $partners = Partner::get();

        $contacts = Contact::get();

        $users = User::get();

        $blog_count = $blogs->count();
        $blog_drafted_count = $blogs->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $blog_published_count = $blogs->filter(function ($item) {
            return $item->status == 1;
        })->count();

        $tag_count = $tags->count();

        $category_count = $categories->count();

        $company_count = $companies->count();
        $company_drafted_count = $companies->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $company_published_count = $companies->filter(function ($item) {
            return $item->status == 1;
        })->count();

        $sector_count = $sectors->count();

        $project_count = $projects->count();
        $project_drafted_count = $projects->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $project_published_count = $projects->filter(function ($item) {
            return $item->status == 1;
        })->count();

        $experience_count = $experiences->count();
        $experience_drafted_count = $experiences->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $experience_published_count = $experiences->filter(function ($item) {
            return $item->status == 1;
        })->count();

        $organization_count = $organizations->count();
        $organization_drafted_count = $organizations->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $organization_published_count = $organizations->filter(function ($item) {
            return $item->status == 1;
        })->count();

        $social_count = $socials->count();
        $social_drafted_count = $socials->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $social_published_count = $socials->filter(function ($item) {
            return $item->status == 1;
        })->count();

        $partner_count = $partners->count();

        $contact_count = $contacts->count();
        $contact_read_count = $contacts->filter(function ($item) {
            return $item->is_read == 1;
        })->count();
        $contact_replied_count = $contacts->filter(function ($item) {
            return $item->is_replied == 1;
        })->count();

        $user_count = $users->count();

        return view('backend.pages.index', [
            'blog_count' => $blog_count,
            'blog_drafted_count' => $blog_drafted_count,
            'blog_published_count' => $blog_published_count,
            'company_count' => $company_count,
            'company_drafted_count' => $company_drafted_count,
            'company_published_count' => $company_published_count,
            'project_count' => $project_count,
            'project_drafted_count' => $project_drafted_count,
            'project_published_count' => $project_published_count,
            'experience_count' => $experience_count,
            'experience_drafted_count' => $experience_drafted_count,
            'experience_published_count' => $experience_published_count,
            'organization_count' => $organization_count,
            'organization_drafted_count' => $organization_drafted_count,
            'organization_published_count' => $organization_published_count,
            'social_count' => $social_count,
            'social_drafted_count' => $social_drafted_count,
            'social_published_count' => $social_published_count,
            'contact_count' => $contact_count,
            'contact_read_count' => $contact_read_count,
            'contact_replied_count' => $contact_replied_count,
            'user_count' => $user_count,
            'tag_count' => $tag_count,
            'category_count' => $category_count,
            'sector_count' => $sector_count,
            'partner_count' => $partner_count,
        ]);
    }
}
