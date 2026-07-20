<?php

namespace App\Livewire\Concerns;

trait WithFlashMessage
{
    public string $flashMessage = '';
    public bool $showFlash = false;

    public function flash(string $message): void
    {
        $this->flashMessage = $message;
        $this->showFlash = true;

        $this->dispatch('flash-message');
    }

    public function dismissFlash(): void
    {
        $this->showFlash = false;
        $this->flashMessage = '';
    }
}
