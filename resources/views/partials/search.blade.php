<form action="{{ route('products.search') }}" class="d-flex mr-3">
   <div class="form-group mb-0">
    <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request()->qry ?? '' }}">
   </div>
    <button type="submit" class="btn btn-info ml-1"><i class="fas fa-search"></i></button>
</form>
