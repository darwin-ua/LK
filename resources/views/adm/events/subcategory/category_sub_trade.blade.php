
<div class="form-group">
    <label for="category">{{ __('translate.Subcategory') }}</label>
    <div id="categories">
        @foreach ($subcategories as $scategory)
            <div>
                <input type="checkbox" name="sub_trade_{{ $scategory->id }}" id="" onchange="" class="category-checkbox" value="{{ $scategory->id }}">
                <label for="cat{{ $scategory->id }}11"><span style="color: #4c6e8d;">{{ $scategory->title }}</span></label>
            </div>
        @endforeach
    </div>
</div>







