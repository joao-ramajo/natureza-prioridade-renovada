    <form action="{{ route($route) }}" method="{{ $method }}" class="w-50 mt-5 mx-auto">
        @csrf

        <h2 class="text-center text-secondary"> <span class="text-success">NPR</span> | {{ $title }}</h2>

        {{ $slot }}

        <input type="submit" value="{{ $btnLabel }}" class="btn btn-success">


        <hr>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p class="mb-2">
                        {{ $error }}
                    </p>
                @endforeach
            </div>
        @endif

    </form>
