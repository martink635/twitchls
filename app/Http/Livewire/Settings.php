<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Settings extends Component
{
    public $followed = false;
    public $user;

    public function mount()
    {
        if (Auth::guest()) {
            return redirect('/');
        }

        $this->user= Auth::user();

        if (array_key_exists('followed', $this->user->settings)) {
            $this->followed = $this->user->settings['followed'];
        }
    }

    public function toggleFollowed()
    {
        $this->followed = !$this->followed;
        $this->user->settings = \array_merge($this->user->settings, ['followed' => $this->followed]);
        $this->user->save();
    }


    public function render()
    {
        return view('livewire.settings');
    }
}
