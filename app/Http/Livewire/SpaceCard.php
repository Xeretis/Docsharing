<?php

namespace App\Http\Livewire;

use App\Models\Space;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class SpaceCard extends Component
{
    public Space $space;

    public string $url = '';

    public bool $expire = false;
    public int $amount = 1;
    public string $unit = "days";

    protected $rules = [
        'expire' => 'required|boolean',
        'amount' => 'exclude_if:expire,false|required|integer',
        'unit' => 'exclude_if:expire,false|required|string|in:months,days,hours,minutes,seconds'
    ];

    public function generate(): void
    {
        $this->validate();

        if ($this->expire) {
            $expireDate = Carbon::now();
            switch ($this->unit) {
                case 'months':
                    $expireDate = $expireDate->addMonths($this->amount);
                    break;
                case 'days':
                    $expireDate = $expireDate->addDays($this->amount);
                    break;
                case 'hours':
                    $expireDate = $expireDate->addHours($this->amount);
                    break;
                case 'minutes':
                    $expireDate = $expireDate->addMinutes($this->amount);
                    break;
                case 'seconds':
                    $expireDate = $expireDate->addSeconds($this->amount);
                    break;
            }
            $this->url = URL::temporarySignedRoute('spaces.join-invite', $expireDate, ['space' => $this->space->hash]);
        } else {
            $this->url = URL::signedRoute('spaces.join-invite', ['space' => $this->space->hash]);
        }
    }

    public function render()
    {
        return view('livewire.space-card');
    }
}
