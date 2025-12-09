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
<div class="dashboard">
    <div class="inner blog-inner">
        <header class="nav blog-nav blog-nav-index">
            <p class="blog-site-title">MoMoYu Blog</p>
            <a href="/" class="blog-page-title-link">
                <h1 class="blog-page-title">{{ $page->title }}</h1>
            </a>
            <p class="blog-description">{{ $page->description }}</p>
        </header>

        <main>
            @if ($posts->count() === 0)
                <div class="box empty-posts-message">
                    还没有文章。试着在 <code class="inline-code">source/_posts</code> 新建一篇 Markdown 文件吧！
                </div>
            @else
                <div class="post-list">
                    @foreach ($posts as $post)
                        @php
                            $postDate = $parsePostDate($post);
                        @endphp
                        <a href="{{ $post->getUrl() }}" class="box post-item">
                            <div class="post-meta">
                                @if ($postDate)
                                    <time datetime="{{ $postDate->format('Y-m-d') }}">{{ $postDate->format('Y 年 n 月 j 日') }}</time>
                                @endif
                            </div>
                            <h3 class="post-title">{{ $post->title }}</h3>
                            <p class="post-description">{{ $post->description ?? '点击阅读全文。' }}</p>
                            @if ($post->tags)
                                <div class="post-tags">
                                    @foreach ($post->tags as $tag)
                                        <span class="post-tag"># {{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
