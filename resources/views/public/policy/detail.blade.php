@extends('public.layouts.layout')

@section('content')

    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="information-panel">
                    <?php if(!empty($detail->description)) { 
                            echo $detail->description;
                    } ?>
                </div>
            </div>
        </div>
    </section>

@endsection