
<div class="form-group">
    <label for="category">{{ __('translate.Subcategory') }}</label>
    <select name="category" id="category" class="form-control">
        @foreach ($categoryData as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
    </select>
</div>









