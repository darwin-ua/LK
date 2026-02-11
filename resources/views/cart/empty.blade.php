@include('cart.filter')

<section class="promo_full">
    <div class="promo_full_wp magnific">
        &nbsp;
    </div>
</section>
<div class="container margin_60">
    <section class="promo_full">
        <div class="promo_full_wp magnific">
            &nbsp;
        </div>
    </section>
    <div class="main_title" style="padding-top: 65px; padding-bottom: 6px;">
        <h2>Корзина пуста</h2>
    </div>

</div>

@include('cart.filter_footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const novaPoshtaRadio = document.getElementById('novaPoshtaRadio');
        const addressDeliveryRadio = document.getElementById('addressDeliveryRadio');
        const personalInfoSection = document.getElementById('personal-info');
        const novaPoshtaInfoSection = document.getElementById('nova-poshta-info');

        novaPoshtaRadio.addEventListener('change', function () {
            if (novaPoshtaRadio.checked) {
                personalInfoSection.style.display = 'none';
                novaPoshtaInfoSection.style.display = 'block';
            }
        });

        addressDeliveryRadio.addEventListener('change', function () {
            if (addressDeliveryRadio.checked) {
                personalInfoSection.style.display = 'block';
                novaPoshtaInfoSection.style.display = 'none';
            }
        });
    });
</script>




