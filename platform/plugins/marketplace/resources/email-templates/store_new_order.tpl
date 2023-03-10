{{ header }}

<h2>Order successfully!</h2>

<p>Hi {{ store_name }},</p>
<p>You receive a new order at {{ site_title }}!</p>

{{ product_list }}

{% if order_note %}
<p>Note: {{ order_note }}</p>
{% endif %}

<h3>Customer information</h3>

<p>{{ customer_name }} - {{ customer_phone }}, {{ customer_address }}</p>

<h3>Shipping method</h3>
<p>{{ shipping_method }}</p>

<h3>Payment method</h3>
<p>{{ payment_method }}</p>

<br />

<p>If you have any question, please contact us via <a href="mailto:{{ site_admin_email }}">{{ site_admin_email }}</a></p>

{{ footer }}
