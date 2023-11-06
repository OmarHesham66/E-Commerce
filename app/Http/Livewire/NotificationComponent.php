<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationComponent extends Component
{
    protected $listeners = ['notify' => 'alert'];

    public function render()
    {
        $admin = Auth::user();
        return view('livewire.Admin.IconNotifyInAdminPanal.notification-component', compact('admin'));
    }
    public function alert($data)
    {
        $user = User::find($data['user_id']);
        $number = $data['order_number'];
        notify()->success("Order #$number Sold By $user->name !!", 'Notification');
    }
}
