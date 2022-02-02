# Limitation of arguments passed to the job

## Goal
-** Understand that there are restrictions on the objects that can be passed as arguments to the job **

## What is serialization / unserialization?
Active Job performs the serialization and unserialization process when saving and queuing a job.

Serialization is the process of converting an object into a string for storage.
unserialization is the opposite, the process of restoring a serialized string to an object.

The job object is serialized when you add the job to the queue and deserialized when you read the job from the queue.
Therefore, the job does not accept all objects as arguments.
Even if it cannot be passed, it can be passed to the job by implementing a serializer that performs serialization processing and unserialization processing. However, you should keep in mind these restrictions.

The objects that can be passed to the job by default are as follows.
  --Basic types (` String`, `Integer`,` Float`, `BigDecimal`,etc)
  --Types that handle date and time (` dateTime`, `Date`, etc.)
  --`Array`

## How serialization / unserialization works
When generating [`Job class`] (https://laravel.com/docs/8.x/queues#generating-job-classes "doc"), we are able to pass an [`Eloquent model`] (https://laravel.com/docs/master/eloquent-serialization "doc") directly into the queued job's constructor. Because of the SerializesModels trait that the job is using, Eloquent models and their loaded relationships will be gracefully serialized and unserialized when the job is processing.

If your queued job accepts an Eloquent model in its constructor, only the identifier for the model will be serialized onto the queue. When the job is actually handled, the queue system will automatically re-retrieve the full model instance and its loaded relationships from the database. This approach to model serialization allows for much smaller job payloads to be sent to your queue driver.

## summary
-** There are restrictions on the objects that can be passed as arguments to the job. ** **