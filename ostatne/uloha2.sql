SELECT col1.*
FROM duplicates col1
JOIN (
    SELECT value
    FROM duplicates
    GROUP BY value
    HAVING COUNT(*) > 1
) dup ON col1.value = dup.value;