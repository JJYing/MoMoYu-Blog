@extends('_layouts.main')

@section('body')
<div class="dashboard">
    <div class="inner blog-inner">
        <header class="nav blog-nav blog-nav-post">
            <img src="/assets/images/blog-logo.avif" alt="MoMoYu Blog Logo" class="nav-bg">
            <p class="blog-site-title">MoMoYu Blog</p>
            <a href="/" class="blog-page-title-link">
                <h1 class="blog-page-title">摸摸鱼研究局</h1>
            </a>
            <a href="/" class="blog-nav-all-posts">回到首页</a>
        </header>

        <main>
            <article class="box article-box">
                <div class="article-header">
                    <div class="article-meta">
                        <span class="article-author">
                            {{ $page->author ?? 'MoMoYu' }}
                        </span>
                        <span aria-hidden="true">·</span>
                        @if ($page->date)
                            @php
                                if ($page->date instanceof \DateTimeInterface) {
                                    $postDate = $page->date;
                                } elseif (is_numeric($page->date)) {
                                    $postDate = (new \DateTime('@' . intval($page->date)))->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                } else {
                                    $postDate = new \DateTime($page->date);
                                }
                            @endphp

                            <time datetime="{{ $postDate->format('Y-m-d') }}">
                                {{ $postDate->format('Y 年 n 月 j 日') }}
                            </time>
                        @endif
                    </div>

                    <h1 class="article-title">{{ $page->title }}</h1>

                    @if ($page->description)
                        <p class="article-description">{{ $page->description }}</p>
                    @endif

                    @if ($page->tags)
                        <div class="post-tags">
                            @foreach ($page->tags as $tag)
                                <span class="post-tag"># {{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="article-divider"></div>

                <div class="article-content">
                    {!! $page->getContent() !!}
                </div>
            </article>
        </main>
    </div>
</div>
@endsection
