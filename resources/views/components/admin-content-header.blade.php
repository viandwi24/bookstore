<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">{{ @$title }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            @isset($breadcrumb)
                @foreach ($breadcrumb as $key => $item)
                    @php $active = ($key == count($breadcrumb)-1) ? 'active' : ''; @endphp
                    @isset($item['url'])
                        <li class="breadcrumb-item {{ $active }}"><a href="{{ @$item['url'] }}">{{ @$item['text'] }}</a></li>
                    @else
                        <li class="breadcrumb-item {{ $active }}">{{ @$item['text'] }}</li>
                    @endisset
                @endforeach
            @else
                <li class="breadcrumb-item active">{{ @$title }}</li>
            @endisset
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->