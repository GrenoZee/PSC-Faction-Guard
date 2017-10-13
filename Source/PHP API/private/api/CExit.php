<?php
/*
 * This class is not really required but provides a clean way to terminate execution from lower levels of the execution stack.
 * When a method wants to terminate execution, it throws this Exception.
 * All top level calls are nested in a try block that with a catch for this Exception and an empty handling code.
 */
class CExit extends Exception {}