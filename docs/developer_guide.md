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

Variables that store boolean values should have prefixes such as ``is_``, ``has_``, or any other appropriate verb.

* Right: ``$is_valid, $has_rendered, $has_children, $use_cache``
* Wrong: ``$valid, $render_flag, $parentness_status, $cache``

6. Names of the variables shouldn’t begin with underscore. There were cases when one function included the ``$cache``, ``$_cache`` and ``$__cache`` variables.


# HTML

1. Write all tags and attribute names only in lowercase.

2. Put all attribute values in double quotes.

3. Use 4-space indentation to structure HTML code.

4. Check all templates for HTML validity. Templates must be HTML5-compliant (<!DOCTYPE html>).

5. Don’t use the style parameter for elements. All styles must stay in an external file, united in classes.

# CSS

1. Use 4-space indentation to structure the code.

2. Use absolute values (px) to specify all sizes. However, relative values are justified in some cases.

3. Divide the CSS file into logical parts with commentaries.
