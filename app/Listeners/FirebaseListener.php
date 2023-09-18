<?php

$database = app('firebase.database');

$database->ref('/products')->onWrite(function ($snapshot) {
  // Get the collection or document that was changed
  $collection = $snapshot->getReference();

  // Check the type of change
  switch ($snapshot->getType()) {
    case 'child_added':
      // Do something when a new document is added to the collection
      break;
    case 'child_changed':
      // Do something when a document is updated
      break;
    case 'child_removed':
      // Do something when a document is deleted
      break;
  }
});
