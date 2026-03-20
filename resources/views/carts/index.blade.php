<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #db2777;">
            Process
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                {{-- Orders Card --}}
                <a href="{{ route('orders.index') }}" style="text-decoration:none;">
                    <div style="background:white; border: 0.5px solid #f9c0d4; border-radius:16px; padding:32px 24px; display:flex; flex-direction:column; align-items:center; gap:16px; transition:all 0.2s; cursor:pointer;"
                         onmouseover="this.style.background='#fff0f5'; this.style.borderColor='#f48fb1';"
                         onmouseout="this.style.background='white'; this.style.borderColor='#f9c0d4';">
                        <div style="width:64px; height:64px; border-radius:16px; background:#fce7f3; display:flex; align-items:center; justify-content:center;">
                            <svg width="32" height="32" fill="none" stroke="#db2777" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <line x1="10" y1="9" x2="8" y2="9"/>
                            </svg>
                        </div>
                        <div style="text-align:center;">
                            <p style="font-size:16px; font-weight:500; color:#72243E; margin:0 0 4px;">Orders</p>
                            <p style="font-size:13px; color:#c084a0; margin:0;">ดูรายการสั่งซื้อ</p>
                        </div>
                        <div style="display:flex; align-items:center; gap:4px; color:#db2777; font-size:13px; font-weight:500;">
                            ดูทั้งหมด
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                        </div>
                    </div>
                </a>

                {{-- Payments Card --}}
                <a href="{{ route('payments.index') }}" style="text-decoration:none;">
                    <div style="background:white; border: 0.5px solid #f9c0d4; border-radius:16px; padding:32px 24px; display:flex; flex-direction:column; align-items:center; gap:16px; transition:all 0.2s; cursor:pointer;"
                         onmouseover="this.style.background='#fff0f5'; this.style.borderColor='#f48fb1';"
                         onmouseout="this.style.background='white'; this.style.borderColor='#f9c0d4';">
                        <div style="width:64px; height:64px; border-radius:16px; background:#fce7f3; display:flex; align-items:center; justify-content:center;">
                            <svg width="32" height="32" fill="none" stroke="#db2777" stroke-width="1.5" viewBox="0 0 24 24">
                                <rect x="1" y="4" width="22" height="16" rx="2"/>
                                <line x1="1" y1="10" x2="23" y2="10"/>
                            </svg>
                        </div>
                        <div style="text-align:center;">
                            <p style="font-size:16px; font-weight:500; color:#72243E; margin:0 0 4px;">Payments</p>
                            <p style="font-size:13px; color:#c084a0; margin:0;">ดูประวัติการชำระเงิน</p>
                        </div>
                        <div style="display:flex; align-items:center; gap:4px; color:#db2777; font-size:13px; font-weight:500;">
                            ดูทั้งหมด
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>