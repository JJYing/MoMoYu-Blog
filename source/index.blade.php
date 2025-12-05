@extends('_layouts.main')

@section('body')
@php
    $parsePostDate = function ($page) {
        if (! $page || ! $page->date) {
            return null;
        }

        if ($page->date instanceof \DateTimeInterface) {
            return $page->date;
        }

        if (is_numeric($page->date)) {
            return (new \DateTime('@' . intval($page->date)))->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        }

        return new \DateTime($page->date);
    };

    $latestPost = $posts->first();
    $latestPostDate = $parsePostDate($latestPost);
@endphp
<div class="min-h-screen bg-slate-50">
    <header class="bg-white border-b border-slate-200">
        <div class="mx-auto max-w-4xl px-6 py-12">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">MoMoYu Blog</p>
            <h1 class="mt-3 text-4xl font-semibold leading-tight text-slate-900">最简单的博客，也能写下值得记录的故事。</h1>
            <p class="mt-4 max-w-3xl text-lg text-slate-600">这里是一个干净的起点：把 Markdown 放在 <code class="rounded bg-slate-100 px-2 py-1">source/_posts</code>，生成的首页会自动展示你的文章列表。</p>

            <div class="mt-8 flex flex-wrap items-center gap-4 text-sm text-slate-600">
                <div class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 font-medium text-slate-700">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    {{ $posts->count() }} 篇文章
                </div>
                <span>最近更新：
                    @if ($posts->count() > 0)
                        {{ $latestPostDate?->format('Y 年 n 月 j 日') }}
                    @else
                        尚无文章
                    @endif
                </span>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-6 py-10">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Latest Posts</p>
                <h2 class="text-2xl font-semibold text-slate-900">最近更新</h2>
            </div>
            <div class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-blue-700">简洁风格</div>
        </div>

        @if ($posts->count() === 0)
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-600">
                还没有文章。试着在 <code class="rounded bg-slate-100 px-2 py-1">source/_posts</code> 新建一篇 Markdown 文件吧！
            </div>
        @else
            <div class="grid gap-6">
                @foreach ($posts as $post)
                    @php
                        $postDate = $parsePostDate($post);
                    @endphp
                    <a href="{{ $post->getUrl() }}" class="group block rounded-2xl border border-slate-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex items-center gap-3 text-sm text-slate-500">
                            @if ($postDate)
                                <time datetime="{{ $postDate->format('Y-m-d') }}">{{ $postDate->format('Y 年 n 月 j 日') }}</time>
                            @endif
                            <span aria-hidden="true">·</span>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">{{ $post->author ?? 'MoMoYu' }}</span>
                        </div>
                        <h3 class="mt-3 text-xl font-semibold text-slate-900 transition group-hover:text-blue-600">{{ $post->title }}</h3>
                        <p class="mt-2 text-slate-600">{{ $post->description ?? '点击阅读全文。' }}</p>
                        @if ($post->tags)
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach ($post->tags as $tag)
                                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700"># {{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </main>
</div>
@endsection
