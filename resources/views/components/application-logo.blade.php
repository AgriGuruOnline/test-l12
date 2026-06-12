<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center select-none']) }}>
    <div class="flex items-center gap-2.5 flex-nowrap" style="white-space: nowrap;">
        <!-- Modern Custom Logo Icon (Proportioned to match text size) -->
        <svg class="w-10 h-10 sm:w-12 sm:h-12 flex-shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="logo-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="hsl(243, 75%, 59%)" />
                    <stop offset="100%" stop-color="hsl(174, 75%, 45%)" />
                </linearGradient>
            </defs>
            <!-- Background element: soft gradient circle -->
            <circle cx="12" cy="12" r="10" stroke="url(#logo-gradient)" stroke-width="1.5" stroke-dasharray="3 3" />
            <!-- C shape -->
            <path d="M9.5 8.5H8C6.62 8.5 5.5 9.62 5.5 11V13C5.5 14.38 6.62 15.5 8 15.5H9.5" stroke="url(#logo-gradient)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            <!-- H shape -->
            <path d="M13 8V16M18.5 8V16M13 12H18.5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <!-- Logo Text with gradient highlighting (Sized proportionally and bolded) -->
        <span class="text-3xl sm:text-4xl font-bold tracking-tight flex items-center gap-2 whitespace-nowrap" style="color: var(--text-title, inherit); white-space: nowrap;">
            <span class="gradient-text font-bold">CH</span>
            <span class="font-bold opacity-90">WEB TECH</span>
        </span>
    </div>
</div>

<style>
    /* Support text gradient for the highlighted "CH" */
    .gradient-text {
        background: linear-gradient(135deg, hsl(243, 75%, 59%), hsl(174, 75%, 45%));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        color: transparent;
        display: inline-block;
    }
</style>
