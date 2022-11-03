<?php
declare(strict_types=1);

// PHP program to find largest
// minimum distance among k points.

// Returns true if it is possible
// to arrange k elements of
// arr[0..n-1] with minimum
// distance given as mid.
function isFeasible(int $mid, array $sittingPlaces, int $n, int $k):bool
{
    // Place first element
    // at arr[0] position
    $pos = $sittingPlaces[0];

    // Initialize count of
    // elements placed.
    $elements = 1;

    // Try placing k elements
    // with minimum distance mid.
    for ($i = 1; $i < $n; $i++) {
        if ($sittingPlaces[$i] - $pos >= $mid) {
            // Place next element if
            // its distance from the
            // previously placed
            // element is greater
            // than current mid
            $pos = $sittingPlaces[$i];
            $elements++;

            // Return if all elements
            // are placed successfully
            if ($elements == $k)
                return true;
        }
    }
    return false;
}

// Returns largest minimum
// distance for k elements
// in arr[0..n-1]. If elements
// can't be placed, returns -1.
function largestMinDist(array $sittingPlaces, int $numberOfSits, int $numberOfStudents):int
{
    // Sort the positions
    sort($sittingPlaces);

    // Initialize result.
    $res = -1;

    // Consider the maximum
    // possible distance
    $left = 1;
    $right = $sittingPlaces[$numberOfSits - 1];

    // left is initialized with 1 and not with arr[0]
    // because, minimum distance between each element
    // can be one and not arr[0]. consider this example:
    // arr[] = {9,12} and you have to place 2 element
    // then left = arr[0] will force the function to
    // look the answer between range arr[0] to arr[n-1],
    // i.e 9 to 12, but the answer is 3 so It is required
    // that you initialize the left with 1

    // Do binary search for
    // largest minimum distance
    while ($left < $right) {
        $mid = (int) (($left + $right) / 2);

        // If it is possible to place
        // k elements with minimum
        // distance mid, search for
        // higher distance.
        if (isFeasible($mid, $sittingPlaces, $numberOfSits, $numberOfStudents)) {
            // Change value of variable
            // max to mid if all elements
            // can be successfully placed
            $res = max($res, $mid);
            $left = $mid + 1;


            // If not possible to place
            // k elements, search for
            // lower distance
        } else {
            $right = $mid;
        }
    }

    return $res;
}

// Driver Code
[$numberOfSits, $numberOfStudents ] = array_map('intval', explode(' ', trim(fgets(STDIN))));
$sittingPlaces = array_map('intval', explode(' ', trim(fgets(STDIN))));

echo largestMinDist($sittingPlaces, $numberOfSits, $numberOfStudents);

// This code is contributed by aj_36
