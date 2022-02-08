<?php

class SinglyLinkedListNode
{
    public $data;
    public $next;

    public function __construct($node_data)
    {
        $this->data = $node_data;
        $this->next = null;
    }
}

class SinglyLinkedList
{
    public $head;
    public $tail;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
    }

    public function insertNode($node_data)
    {
        $node = new SinglyLinkedListNode($node_data);

        if (is_null($this->head)) {
            $this->head = $node;
        } else {
            $this->tail->next = $node;
        }

        $this->tail = $node;
    }
}

function printSinglyLinkedList($node, $sep, $fptr)
{
    while (!is_null($node)) {
        fwrite($fptr, $node->data);

        $node = $node->next;

        if (!is_null($node)) {
            fwrite($fptr, $sep);
        }
    }
}

/*
 * Complete the 'reverse' function below.
 *
 * The function is expected to return an INTEGER_SINGLY_LINKED_LIST.
 * The function accepts INTEGER_SINGLY_LINKED_LIST llist as parameter.
 */

/*
 * For your reference:
 *
 * SinglyLinkedListNode {
 *     int data;
 *     SinglyLinkedListNode next;
 * }
 *
 */
function reverse(SinglyLinkedListNode $head): SinglyLinkedListNode
{
    $cur = $head;
    $next = $cur->next;

    // If only one node
    if ($next === null) {
        return $cur;
    }

    $next2 = $next->next;
    $cur->next = null;
    $next->next = $cur;

    // If only two nodes
    if ($next2 === null) {
        return $next;
    }

    do {
        $cur = $next;
        $next = $next2;
        $next2 = $next->next;
        $next->next = $cur;
    } while ($next2 !== null);

    return $next;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $tests);

for ($tests_itr = 0; $tests_itr < $tests; $tests_itr++) {
    $llist = new SinglyLinkedList();

    fscanf($stdin, "%d\n", $llist_count);

    for ($i = 0; $i < $llist_count; $i++) {
        fscanf($stdin, "%d\n", $llist_item);
        $llist->insertNode($llist_item);
    }

    $llist1 = reverse($llist->head);

    printSinglyLinkedList($llist1, " ", $fptr);
    fwrite($fptr, "\n");
}

fclose($stdin);
fclose($fptr);
