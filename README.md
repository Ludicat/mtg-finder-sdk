# MTG Finder SDK

This is a PHP SDK for the MTG Finder API. It provides a simple way to interact with the API.

## Installation

You can install the package via composer:

```bash
composer require ludicat/mtg-finder-sdk
```

## Usage

Create an API key in your account settings on the [MTG Finder website](https://www.mtg-finder.org/api_key/create#/).
You can find a detailled documentation on the [MTG Finder API documentation](https://www.mtg-finder.org/api/doc).

You have to instantiate a client.
It will be passed through any API endpoint.

```php
use Ludicat\MTGFinder\Client;

$client = new Client('YOUR_API_KEY');
```

## Endpoints

### Formats

You have to set the formats on an event.
In order to do, you'll have to use their ID.
You can get a complete id list (along with their names) by using the `get` method on the `Formats` endpoint.

```php
use Ludicat\MTGFinder\Api\Formats;

$formatsApi = new Formats($client);
/** @var array<Ludicat\MTGFinder\Model\Format> $availableFormats */
$availableFormats = $formatsApi->get();
```

### Geoname

MTG Finder uses the Geoname API to get the list of countries.
You can get on by ID or search for by city name, zipcode or GPS coordinates on the `Geoname` endpoint.

```php
use Ludicat\MTGFinder\Api\Geoname;

$geonameApi = new Geoname($client);
/** @var Ludicat\MTGFinder\Model\Geoname|null $data */
$data = $geonameApi->get(123);
/** @var array<Ludicat\MTGFinder\Model\Geoname> $data */
$data = $geonameApi->search('FR', 'Paris'); // Could either be a city name or a zipcode
/** @var array<Ludicat\MTGFinder\Model\Geoname> $data */
$data = $geonameApi->searchZip('FR', '75001');
/** @var array<Ludicat\MTGFinder\Model\Geoname> $data */
$data = $geonameApi->searchCity('FR', 'Paris');
/** @var Ludicat\MTGFinder\Model\Geoname|null $data */
$data = $geonameApi->searchCoord(42.5833, 1.6667);
```

### Events

The main purpose of the API is to sync your website and create an event automatically.
We recommand you to get your formats and geonames before creating an event.

```php
use Ludicat\MTGFinder\Api\Event;
use Ludicat\MTGFinder\Model\Event as EventModel;

$eventApi = new Event($client);
$eventApi->create([
    'state' => EventModel::STATE_PUBLISHED,
    'name' => 'Test event',
    'description' => 'This is a test event',
    'formats' => [
        ['id' => 1],
        ['id' => 2],
        ['id' => 5],
    ],
    'address' => [
        'street' => '1, street of the test',
        'additional' => 'Appartement 42',
        'name' => 'The bar next door',
        'geoname' => [
            'id' => 123
        ],
        'latitude' => 48.8566,
        'longitude' => 2.3522,
    ],
    'maxPeople' => 16,
    'startAt' => '2024-01-01 19:00:00',
    'endAt' => '2024-01-01 23:00:00',
    'publication' => 'Check my new tournament !',
]);
```

## Testing

You have to create the docker environment before running the tests.

```bash
make build
make test
```

## Troubleshooting

If you encounter any issue, please create an issue on the repository:
[https://github.com/Ludicat/mtg-finder-sdk/issues](https://github.com/Ludicat/mtg-finder-sdk/issues)

Remember that any abuse of the API will result in a ban of your account.
