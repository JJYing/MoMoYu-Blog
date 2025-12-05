@extends('_layouts.main')

@section('body')
<div class="min-h-screen bg-slate-50">
    <header class="bg-white border-b border-slate-200">
        <div class="mx-auto flex max-w-4xl items-center justify-between px-6 py-6">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">MoMoYu Blog</p>
                <a href="/" class="text-lg font-semibold text-slate-900 transition hover:text-blue-600">回到首页</a>
            </div>
            <a href="/" class="text-sm font-medium text-blue-600 hover:text-blue-700">所有文章</a>
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-6 py-10">
        <article class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">
            <div class="space-y-4 px-8 py-10">
                <div class="flex items-center gap-3 text-sm text-slate-500">
                    <span class="inline-flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                        {{ $page->author ?? 'MoMoYu' }}
                    </span>
                    <span aria-hidden="true">·</span>
                    <time datetime="{{ $date->format('Y-m-d') }}">{{ $date->format('Y 年 n 月 j 日') }}</time>
                </div>

                <h1 class="text-3xl font-semibold leading-tight text-slate-900">{{ $page->title }}</h1>

                @if ($page->description)
                    <p class="text-lg text-slate-600">{{ $page->description }}</p>
                @endif

                @if ($page->tags)
                    <div class="flex flex-wrap gap-2">
                        @foreach ($page->tags as $tag)
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700"># {{ $tag }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="border-t border-slate-100"></div>

            <div class="article-content px-8 py-10 text-slate-800">
                {!! $page->getContent() !!}
            </div>
        </article>
    </main>
</div>
@endsection
