<?php

namespace App\Http\Livewire\ServiceGroups;

use App\Models\ServiceGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'Name';
    public $sorts = ['Name', 'Newest', 'Oldest'];
    public $filter = 'All';
    public $filters = ['All', 'First 100'];

    protected $listeners = ['$refresh'];

    public function route()
    {
        return Route::get('service-groups', static::class)
            ->name('service-groups')
            ->middleware('auth');
    }

    public function render()
    {
        return view('service-groups.index', [
            'serviceGroups' => $this->query()->paginate(),
        ]);
    }

    public function query()
    {
        $query = ServiceGroup::query();

        if ($this->search) {
            $query->where(function (Builder $query) {
                $query->where('id', 'like', '%' . $this->search . '%');
                $query->orWhere('name', 'like', '%' . $this->search . '%');
            });
        }

        switch ($this->sort) {
            case 'Name': $query->orderBy('name'); break;
            case 'Newest': $query->orderByDesc('created_at'); break;
            case 'Oldest': $query->orderBy('created_at'); break;
        }

        switch ($this->filter) {
            case 'All': break;
            case 'First 100': $query->where('id', '<=', 100); break;
        }

        return $query;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(ServiceGroup $serviceGroup)
    {
        $serviceGroup->delete();

        $this->emit('showToast', 'success', __('Service Group deleted!'));
    }
}
