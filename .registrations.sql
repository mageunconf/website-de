SELECT base_price_incl_tax - i.discount_amount, COUNT(*) FROM sales_flat_order_item i
INNER JOIN sales_flat_order o ON o.entity_id = i.order_id
WHERE status = 'complete' AND sku = 'mageunconf-2017'
GROUP BY base_price_incl_tax - i.discount_amount;

SELECT product_options FROM sales_flat_order_item i
INNER JOIN sales_flat_order o ON o.entity_id = i.order_id
WHERE status = 'complete' AND sku = 'LEJ-4';
