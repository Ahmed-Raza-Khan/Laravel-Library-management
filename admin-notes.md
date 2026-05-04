Solid Principles
Robert J.Martin (Uncle Bob)
Solid Acronym intrduces it later by Michael feathers

why need them ? 
"To create understandable, readable, and testable, code that may developers can collabratively work on."

1 - Single Responsibility principle.
2 - Open-Closed principle.
3 - Liskov's Substitution Principle.
4 - Interface Segregation Principle.
5 - Dependency Inversion Principle.


1. Single Responsibility Principle

"A Class should should do one thing and therefore it should have only a single reason to change."

for example: we have a to show the circle one class is calculating the area of a circle and second class is showing the circle and the third class is showing the circle and now our system is using the Single Responsibility Principle.

2. Open-Closed principle

"A Class should be open for extension but it should be closed to modification."

for example: first we have a single class that is circle and now we want to add a rectangle class it have lenght width and its printing function then we go to the shape function that is creating the cicle and now we add the new shape that is rectrangle and here we add its lenght and its width and now we goto printer system and it will print the  by the class that is called ishape so we now no need to make the new class for printer by ishape extend function it will automactically print the circle and rectangle with out tell the prin ter to what to print and now or code is following the Single Responsibility Principle.

3. Liskov's Substitution Principle

"Derived or child classes must be substitutable for their base or parent classes."

for example: Inheriting Square from Rectangle can be problematic because a square's side logic differs from a rectangle's length/width logic. if a subclass cannot truly substitute its parent, the inheritance structure should be redesigned (e.g., making both inherit from IShape and now or code is following the Liskov's Substitution Principle.

4. Interface Segregation Principle

"Classes should not be forced to implement a function they do not need."

for example: A 3D shape like a Cube shouldn't be forced to implement a GetArea method from a 2D interface. The solution is to split interfaces into specific ones, such as I2DShape (with GetArea) and I3DShape (with GetVolume).

5. Dependency Inversion Principle

"High level classes should not depand on low-level classes. both should depand upon abstraction."

for example: Instead of the Program class depending directly on a concrete Printer class, it should depend on an IPrinter interface. This makes it easy to swap different types of printers (like a File Printer or Console Printer) without changing the high-level logic





and now its for laravel


1. Single Responsibility Principle (SRP)

Concept: A class should do only one thing. In Laravel, avoid "Fat Controllers" that handle validation, DB logic, and emails all at once.

Bad Example: A controller doing everything.

Good Example: Moving logic to a Service class.

// Service class handles the business logic
class OrderService {
    public function create(array $data) {
        return Order::create($data);
    }
}

// Controller only handles the request/response
class OrderController extends Controller {
    public function store(Request $request, OrderService $orderService) {
        $order = $orderService->create($request->all());
        return response()->json($order);
    }
}


2. Open/Closed Principle (OCP)
Concept: You should be able to add new functionality without changing existing code. In Laravel, this is often achieved using Interfaces and Drivers.

Scenario: You want to support multiple payment gateways (Stripe, PayPal).

interface PaymentGateway {
    public function process($amount);
}

class StripeGateway implements PaymentGateway {
    public function process($amount) { /* Stripe Logic */ }
}

class PayPalGateway implements PaymentGateway {
    public function process($amount) { /* PayPal Logic */ }
}

// You can add a 'SquareGateway' later without changing the Checkout class
class Checkout {
    public function begin(PaymentGateway $gateway, $amount) {
        $gateway->process($amount);
    }
}


3. Liskov Substitution Principle (LSP)
Concept: A subclass should be able to replace its parent class without breaking the app. In Laravel, this usually means ensuring all implementations of an interface return the same data type.

Example: If an interface says a method returns a Collection, a child class shouldn't return an Array.

interface LessonRepository {
    public function getAll(): Collection; // Must return a Laravel Collection
}

class DbLessonRepository implements LessonRepository {
    public function getAll(): Collection {
        return Lesson::all(); // Correct
    }
}

class FileLessonRepository implements LessonRepository {
    public function getAll(): Collection {
        return collect(['Lesson 1', 'Lesson 2']); // Must wrap in collect() to maintain type
    }
}


4. Interface Segregation Principle (ISP)
Concept: Don't force a class to implement methods it doesn't need. Split large interfaces into smaller, specific ones.

Scenario: Managing workers where some are human and some are robots.

interface Workable {
    public function work();
}

interface Sleepable {
    public function sleep();
}

class HumanWorker implements Workable, Sleepable {
    public function work() { /* ... */ }
    public function sleep() { /* ... */ }
}

class RobotWorker implements Workable {
    public function work() { /* ... */ }
    // Robots don't need the Sleepable interface!
}


5. Dependency Inversion Principle (DIP)
Concept: Depend on abstractions (Interfaces), not concrete classes. Laravel’s Service Container and Dependency Injection make this easy.

Example: Injecting an Interface into a Controller instead of a specific Class.

// In a Service Provider
$this->app->bind(NewsletterInterface::class, MailchimpService::class);

// In your Controller
class NewsletterController extends Controller {
    protected $newsletter;

    // We type-hint the Interface, not the specific Mailchimp class
    public function __construct(NewsletterInterface $newsletter) {
        $this->newsletter = $newsletter;
    }

    public function subscribe() {
        $this->newsletter->subscribe(request('email'));
    }
}
