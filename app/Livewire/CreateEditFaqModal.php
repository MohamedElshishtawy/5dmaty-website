<?php

namespace App\Livewire;

use App\Models\Faq;
use LivewireUI\Modal\ModalComponent;

class CreateEditFaqModal extends ModalComponent
{
    public ?int $faqId = null;
    public string $question = '';
    public string $answer = '';
    public int $order = 0;

    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'order' => ['required', 'integer', 'min:0'],
        ];
    }

    public function mount($faq = null): void
    {
        if ($faq) {
            if (is_numeric($faq)) {
                $faqModel = Faq::findOrFail($faq);
            } else {
                $faqModel = $faq;
            }

            $this->faqId = $faqModel->id;
            $this->question = $faqModel->question;
            $this->answer = $faqModel->answer;
            $this->order = (int) $faqModel->order;
        }
    }

    public function save(): void
    {
        $this->validate();

        if ($this->faqId) {
            $faq = Faq::findOrFail($this->faqId);
            $faq->update([
                'question' => $this->question,
                'answer' => $this->answer,
                'order' => $this->order,
            ]);
        } else {
            Faq::create([
                'question' => $this->question,
                'answer' => $this->answer,
                'order' => $this->order,
                'is_active' => true,
            ]);
        }

        $this->dispatch('faqUpdated');
        $this->closeModal();
    }
}





















