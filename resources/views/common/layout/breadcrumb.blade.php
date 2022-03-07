<section class="team-list-s-f-1">
    <div class="container">
        <div class="row row-align-center">
            <div class="col-md-6 pl-0">
                <h2 class="page-heading">{{ $breadcrumbs['title']}}</h2>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">@lang('messages.home')</a>
                        </li>
                        <?php echo $breadcrumbs['breadcrumbs']; ?>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>