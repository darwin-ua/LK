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
                <input type="radio" name="cours_{{ $category->id }}" id="cat{{ $category->id }}" onchange="handleCheckboxChange('{{ $category->select_id }}', '{{ $category->id }}')" class="category-checkbox" name="category" value="{{ $category->id }}">
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


<div class="form-group" id="currency_panel">
    <label for="amount_id">On to on lesson </label>
    <!-- Панель для customCheckbox1 -->
    <div id="panel1" class="hidden-panel" style="border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 4px;padding: 10px;margin-top: 10px;">
        <div class="group-panel">
            <label for="timeTo1Group1">Discount %:</label>
            <input type="text" id="discount1" name="discount1">
        </div>
    </div>
    <br>
    <label for="amount_id">Group lesson</label>
    <!-- Панель для customCheckbox2 -->
    <div id="panel2" class="hidden-panel" style="border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 4px;padding: 10px;margin-top: 10px;">
        <div class="group-panel">
            <h4>Group 1</h4>
            <label for="timeFrom22Group22">Time from:</label>
            <input type="time" id="timeFrom22Group22" name="timeFrom22Group22">
            <label for="timeTo22Group22">Time to:</label>
            <input type="time" id="timeTo22Group22" name="timeTo22Group22" >
        </div>
        <div class="group-panel">
            <label for="timeTo1Group1">Discount %:</label>
            <input type="text" id="discount3" name="discount3" >
        </div>
        <div class="group-panel">
            <h4>Groupe 2</h4>
            <label for="timeFrom33Group33">Time from:</label>
            <input type="time" id="timeFrom33Group33" name="timeFrom33Group33" >
            <label for="timeTo33Group33">Time to:</label>
            <input type="time" id="timeTo1Group33" name="timeTo33Group33" >
        </div>
        <div class="group-panel">
            <label for="timeTo1Group1">Discount %:</label>
            <input type="text" id="discount4" name="discount4">
        </div>
    </div>
</div>








