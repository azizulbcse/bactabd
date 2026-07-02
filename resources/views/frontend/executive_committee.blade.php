<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@extends('layouts.app')

@section('title', 'Executive Committee | BACTA Bangladesh')

@section('content')

    {{-- HEADER BANNER --}}
    <header class="relative overflow-hidden py-14 border-b border-[#CFEAF5]" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 50%, #E0F2FE 100%);">
        <div class="absolute inset-0 opacity-[0.04] bg-[linear-gradient(to_right,#0284C7_1px,transparent_1px),linear-gradient(to_bottom,#0284C7_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row justify-between items-center gap-4 text-center lg:text-left">
            <div>
                <span class="text-xs font-medium tracking-[0.18em] text-[#0284C7] uppercase block mb-2">Governance & Membership</span>
                <h1 class="text-3xl lg:text-4xl font-semibold tracking-tight text-[#0F172A]">Executive Committee</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-[#0284C7] transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#0F172A]">Committee Members</span>
            </div>
        </div>
    </header>

    {{-- MEMBERS GRID --}}
    <section class="py-14" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 60%, #E0F2FE 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="infinite-member-container">
                @foreach($executives as $row)
                <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm hover:-translate-y-1 hover:shadow-md transition-all duration-300 overflow-hidden flex flex-col">

                    {{-- Top accent bar --}}
                    <div class="h-1 w-full bg-gradient-to-r from-[#0284C7] to-[#00ADB5]"></div>

                    <div class="p-6 flex flex-col flex-grow">

                        {{-- Rank badge --}}
                        <div class="flex items-center justify-between mb-5">
                            <span class="text-[10px] font-medium text-[#0284C7] bg-sky-50 border border-[#CFEAF5] px-2.5 py-1 rounded-lg tracking-wide">
                                # {{ $row->sort_order }}
                            </span>
                            <span class="text-[10px] font-medium text-slate-400 bg-slate-50 border border-slate-100 px-2.5 py-1 rounded-lg uppercase tracking-wide">
                                {{ $row->bactaDesignation->name ?? 'Executive Member' }}
                            </span>
                        </div>

                        {{-- Photo — smart rounded square --}}
                        <div class="flex justify-center mb-5">
                            <div class="w-28 h-28 rounded-2xl overflow-hidden bg-slate-50 shadow-sm flex items-center justify-center">
                                @if($row->member_pic)
                                    <img src="{{ asset('storage/' . $row->member_pic) }}" alt="{{ $row->name }}" class="w-full h-full object-cover" loading="lazy">
                                @else
                                    <i class="fas fa-user-md text-4xl text-slate-300"></i>
                                @endif
                            </div>
                        </div>

                        {{-- Name & designation --}}
                        <div class="text-center space-y-1 mb-5">
                            <h3 class="text-base font-semibold text-slate-900 leading-snug">{{ $row->name }}</h3>
                            <p class="text-xs text-slate-400">{{ $row->medicalDesignation->name ?? 'N/A' }}</p>
                        </div>

                        {{-- Hospital --}}
                        <div class="mt-auto bg-[#F0FDFF] border border-[#CFEAF5] rounded-xl px-4 py-3 text-center">
                            <p class="text-xs text-slate-600 leading-snug">
                                <i class="fas fa-hospital text-[#0284C7] mr-1 text-[10px]"></i>
                                {{ $row->hospital->name ?? 'N/A' }}
                            </p>
                            @if($row->hospital->short_name)
                                <span class="inline-block mt-1.5 text-[10px] font-medium text-[#0284C7] bg-sky-50 border border-[#CFEAF5] px-2 py-0.5 rounded-md tracking-wide uppercase">
                                    {{ $row->hospital->short_name }}
                                </span>
                            @endif
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            {{-- Infinite scroll loader --}}
            <div id="scroll-infinity-loader" class="text-center mt-10 hidden">
                <div class="inline-flex items-center gap-2 text-xs text-slate-400">
                    <svg class="animate-spin w-4 h-4 text-[#0284C7]" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                    Loading more members...
                </div>
            </div>

        </div>
    </section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let nextPageUrl = "{{ method_exists($executives, 'nextPageUrl') ? $executives->nextPageUrl() : '' }}";
        let container = document.getElementById('infinite-member-container');
        let loader = document.getElementById('scroll-infinity-loader');
        let isLoading = false;

        if (!nextPageUrl && loader) { loader.style.display = 'none'; return; }

        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !isLoading && nextPageUrl) loadMore();
            });
        }, { rootMargin: '0px 0px 300px 0px', threshold: 0 });

        if (loader) scrollObserver.observe(loader);

        function loadMore() {
            isLoading = true;
            if (loader) loader.classList.remove('hidden');
            fetch(nextPageUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.text())
                .then(html => {
                    let doc = new DOMParser().parseFromString(html, 'text/html');
                    let newCards = doc.getElementById('infinite-member-container');
                    if (newCards) Array.from(newCards.children).forEach(c => container.appendChild(c));
                    let next = doc.querySelector('a[rel="next"]');
                    nextPageUrl = next ? next.getAttribute('href') : '';
                    isLoading = false;
                    if (loader) loader.classList.add('hidden');
                    if (!nextPageUrl && loader) { scrollObserver.unobserve(loader); loader.style.display = 'none'; }
                })
                .catch(() => { isLoading = false; if (loader) loader.classList.add('hidden'); });
        }
    });
</script>

@endsection