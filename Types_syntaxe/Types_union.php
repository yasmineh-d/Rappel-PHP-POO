<?php
function normalizeId(int|string $id): int {
    if (is_string($id)) {
        $id = (int)trim($id);
    }
    return max(0, $id);
}

function toBool(bool|string|int|null $v): bool {
    if (is_bool($v)) return $v;
    return in_array(strtolower((string)$v), ['1','true','yes','y','on'], true);
}

var_dump(normalizeId('42'));   // int(42)
var_dump(toBool('OFF'));       // bool(false)
var_dump(toBool('YES'));       // bool(true)
