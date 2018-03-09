# PiPHP: GPIO (Composerless)

A library for low level access to the GPIO pins on a Raspberry Pi. These pins can be used to control outputs (LEDs, motors, valves, pumps) or read inputs (sensors).

## Installing

Download the zip, include the "GPIO" folder in your project and require any needed files in your php script.

## Examples

### Setting Output Pins
```php
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'GPIO/GPIO.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'GPIO/Pin/PinInterface.php');

// Create a GPIO object
$gpio = new GPIO();

// Retrieve pin 18 and configure it as an output pin
$pin = $gpio->getOutputPin(18);

// Set the value of the pin high (turn it on)
$pin->setValue(PinInterface::VALUE_HIGH);
```

### Input Pin Interrupts
```php
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'GPIO/GPIO.php');
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'GPIO/Pin/InputPinInterface.php');

// Create a GPIO object
$gpio = new GPIO();

// Retrieve pin 18 and configure it as an input pin
$pin = $gpio->getInputPin(18);

// Configure interrupts for both rising and falling edges
$pin->setEdge(InputPinInterface::EDGE_BOTH);

// Create an interrupt watcher
$interruptWatcher = $gpio->createWatcher();

// Register a callback to be triggered on pin interrupts
$interruptWatcher->register($pin, function (InputPinInterface $pin, $value) {
    echo 'Pin ' . $pin->getNumber() . ' changed to: ' . $value . PHP_EOL;

    // Returning false will make the watcher return false immediately
    return true;
});

// Watch for interrupts, timeout after 5000ms (5 seconds)
while ($interruptWatcher->watch(5000));
```

## Credits

Original code by [AndrewCarterUK ![(Twitter)](http://i.imgur.com/wWzX9uB.png)](https://twitter.com/AndrewCarterUK)
