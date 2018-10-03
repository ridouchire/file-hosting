# PHP
1. The code must fully comply with PSR-1 and PSR-2.

2. Use PHP Coding Standards Fixer to check your code for compliance with those standards.

3. The names of variables must be written in lowercase, using the Snake case format (``$file_type``).

4. Names must be meaningful and informative.
*  Right:
``$counter, $user_id, $product, $is_valid``
* Wrong:
``$с, $uid, $obj, $flag``


5. Variables that store the list of multiple objects of the same type should have the _list suffix, for example: $products_list, $cart_applied_promotions_list. That way it’s easier to determine which variable stores the list and which variable stores an element of the list. Take this array iteration in the foreach cycle, for example:

* Right:

```
foreach ($applied_promotion_list as $applied_promotion) {
    // the variables are easy to 
}
```
* Wrong:

```
foreach ($applied_promotions as $applied_promotion) {
    // it is easy to mistake $applied_promotions for $applied_promotion when you look through the code
}
```


Variables that store boolean values should have prefixes such as ``is_``, ``has_``, or any other appropriate verb.

* Right: ``$is_valid, $has_rendered, $has_children, $use_cache``
* Wrong: ``$valid, $render_flag, $parentness_status, $cache``

6. Names of the variables shouldn’t begin with underscore. There were cases when one function included the ``$cache``, ``$_cache`` and ``$__cache`` variables.



# HTML

# CSS

# Server configuration.
