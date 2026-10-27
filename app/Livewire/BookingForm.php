<?php

namespace App\Livewire;

use App\Models\CatalogItem;
use App\Models\Category;
use App\Models\WaClickLog;
use App\Services\WhatsAppLink;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;

class BookingForm extends Component
{
    #[Rule('required|string|min:2|max:100', message: [
        'required' => 'Nama lengkap wajib diisi.',
        'min' => 'Nama minimal 2 karakter.',
        'max' => 'Nama maksimal 100 karakter.',
    ])]
    public string $name = '';

    #[Rule('required|array|min:1', message: [
        'required' => 'Pilih minimal satu layanan perawatan.',
        'min' => 'Pilih minimal satu layanan perawatan.',
    ])]
    public array $selectedServices = [];

    #[Rule('required|date|after_or_equal:today', message: [
        'required' => 'Pilih tanggal kedatangan.',
        'after_or_equal' => 'Tanggal tidak boleh di masa lampau.',
    ])]
    public string $date = '';

    #[Rule('required|string', message: [
        'required' => 'Pilih perkiraan jam kedatangan.',
    ])]
    public string $time = '10:00';

    #[Rule('nullable|string|max:500')]
    public string $notes = '';

    public ?string $generatedWaUrl = null;

    public function mount()
    {
        $this->date = date('Y-m-d');
        
        // Cek jika ada preselected service dari query string
        $preselectedId = request()->query('service');
        if ($preselectedId && CatalogItem::where('id', $preselectedId)->exists()) {
            $this->selectedServices[] = (int) $preselectedId;
        }
    }

    public function getSelectedServiceNamesProperty(): string
    {
        if (empty($this->selectedServices)) {
            return '- Belum memilih layanan -';
        }

        $items = CatalogItem::whereIn('id', $this->selectedServices)->pluck('name')->toArray();

        return implode(', ', $items);
    }

    public function getFormattedDateProperty(): string
    {
        if (empty($this->date)) {
            return date('d F Y');
        }

        try {
            return Carbon::parse($this->date)->isoFormat('dddd, D MMMM Y');
        } catch (\Throwable $e) {
            return $this->date;
        }
    }

    public function getPreviewMessageProperty(): string
    {
        return WhatsAppLink::getMessage('booking', [
            'nama' => $this->name ?: '[Nama Anda]',
            'layanan' => $this->selected_service_names,
            'tanggal' => $this->formatted_date,
            'jam' => $this->time ? "{$this->time} WIB" : '[Jam]',
            'catatan' => $this->notes ?: '-',
        ]);
    }

    public function submit()
    {
        $this->validate();

        WaClickLog::record('booking_submit', 'general', null, '/booking');

        $waUrl = WhatsAppLink::build('booking', [
            'nama' => $this->name,
            'layanan' => $this->selected_service_names,
            'tanggal' => $this->formatted_date,
            'jam' => "{$this->time} WIB",
            'catatan' => $this->notes ?: '-',
        ]);

        $this->generatedWaUrl = $waUrl;

        // Redirect langsung ke WhatsApp
        return redirect()->away($waUrl);
    }

    public function render()
    {
        $categoriesWithServices = Category::active()
            ->services()
            ->with(['activeItems' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->get();

        $timeSlots = [
            '09:00', '10:00', '11:00', '13:00', '14:00', '15:30', '17:00', '18:30', '19:30',
        ];

        return view('livewire.booking-form', [
            'categories' => $categoriesWithServices,
            'timeSlots' => $timeSlots,
        ]);
    }
}
