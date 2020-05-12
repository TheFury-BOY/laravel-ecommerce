
    @foreach ($product->categories as $category)
    {{ $category->name }}{{ $loop->last ? '' : ', ' }}
    @endforeach

