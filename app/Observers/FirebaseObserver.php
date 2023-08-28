<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\Firestore;
use Kreait\Firebase\Observer\FirebaseObserver;

// Load your service account JSON
$serviceAccountJson = 'jbus-8f9bf-firebase-adminsdk-ai17o-df9754ead0.json';
$factory = (new Factory)->withServiceAccount(file_get_contents($serviceAccountJson));

// Create a Firebase Firestore instance
// $firestore = $factory->createFirestore();

// Reference the document you want to observe
$documentRef = app('firebase.firestore')->database()->collection('your_collection')->document('your_document_id');

// Create a FirebaseObserver for the document
$observer = new FirebaseObserver($documentRef);

// Define a callback function to be executed when changes occur
$observer->onSnapshot(function ($snapshot) {
    // Handle the changes in the document snapshot
    $data = $snapshot->data(); // Get the data of the changed document
    // Perform actions based on the changed data
    // For example, you can log or process the data here
    // You can also update your application's UI or perform other tasks
    // based on the changes in the document.
});

// Start listening for changes
$observer->start();

// Keep the observer running (e.g., in a loop) or stop it when needed
// $observer->stop();
