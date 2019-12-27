<h2 class="my-4"><a href="{{ route('shop') }}">Categories</a></h2>
<div class="list-group">
    @foreach($categories as $category)
		<a class="category list-group-item" categoryId="{{ $category->id }}">{{ $category->name }}</a>
    @endforeach
</div>

<div class="panel list">
    <div class="panel-heading">
        <h4 class="panel-title" data-toggle="collapse" data-target="#panelOne" aria-expanded="true">Sort By </h4>
    </div>
	<div class="panel-body" id="panelOne">
	    <div class="radio disabled">
			<label><input type="radio" name="sorting" value="newest"  class="sort_rang sorting"> Newest</label>
		</div> 
		<div class="radio">
			<label><input type="radio" name="sorting" value="low"  class="sort_rang sorting"> Price: Low to High</label>
		</div>
		<div class="radio">
			<label>
                <input type="radio" name="sorting" value="high"  class="sort_rang sorting">
                Price: High to Low</label>
		</div>								                              
	</div>
</div>