<div class="menu">
    <div class="menu__logo">
        M.A.S
    </div>
    <div class="menu__items">
        @foreach ($technologies as $technology)
            <a href="{{ $technology->technology_link  }}" class="menu__item">
                {{ $technology->technology_name }}
            </a>

        @endforeach
    </div>
</div>

<style>
    .menu__item {
        color: #5d8ebd;
        text-decoration: none;
        line-height: 1.125em;
        font-size: 1.2em;
        word-wrap: break-word;
    }
</style>
