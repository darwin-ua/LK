<style>
    #categories {
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
    }
</style>

<div class="form-group">
    <label>{{ __('translate.Category') }}</label>
    <div id="categories">
        @foreach ($categoryData as $category)
            <div>
                <input type="radio" name="event_{{ $category->id }}" id="cat{{ $category->id }}" onchange="handleCheckboxChange('{{ $category->select_id }}', '{{ $category->id }}')" class="category-checkbox" name="category" value="{{ $category->id }}">
                <label for="cat{{ $category->id }}"><span>{{ $category->title }}</span></label>
            </div>
        @endforeach
    </div>
</div>

<div id="subcategory-container"></div>

<script>

    function handleCheckboxChange(categoryId, id) {

        // Остальная часть вашей функции остаётся без изменений
        fetch('/admin/category/fetch-subcategory', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ categoryId: categoryId, id: id })
        })
            .then(response => response.text())
            .then(html => {
                document.querySelector('#subcategory-container').innerHTML = html;
            })
            .catch(error => console.error('Ошибка:', error));
    }
</script>








