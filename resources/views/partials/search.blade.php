<form action="{{ route('products.search') }}" class="mr-2">
    <div class="form-group mb-0 d-flex">
        <input type="text" name="search" class="form-control" placeholder="Rechercher..."
            value="{{ request()->search ?? '' }}">
        <button type="submit" class="btn btn-info ml-1"><i class="fas fa-search"></i></button>
    </div>
</form>
