<?php

namespace Tests\Unit;

use App\Container;
use App\Exception\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->router = new Router(new Container());
    }

    /** @test */
    public function it_registers_a_route(): void
    {
        // given that we have router object
//        $router = new Router();

        // when we call a register method
        $this->router->register('get', '/users', ['Users', 'index']);

        // then assert route was registered
        $expected = [
            'get' => [
                '/users' => ['Users', 'index']
            ]
        ];
        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test  */
    public function it_registers_a_get_route(): void
    {
        // given that we have router object
//        $router = new Router();

        // when we call a register method
        $this->router->get('/users', ['Users', 'index']);

        // then assert route was registered
        $expected = [
            'get' => [
                '/users' => ['Users', 'index']
            ]
        ];
        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test  */
    public function it_registers_a_post_route(): void
    {
        // given that we have router object
//        $router = new Router();

        // when we call a register method
        $this->router->post('/users', ['Users', 'store']);

        // then assert route was registered
        $expected = [
            'post' => [
                '/users' => ['Users', 'store']
            ]
        ];
        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test  */
    public function there_are_no_routes_when_router_is_created(): void
    {
//        $router = new Router();

        $this->assertEmpty((new Router(new Container()))->routes());
    }

    /**
     * @test
     * @dataProvider Tests\DataProviders\RouterDataProvider::routeNotFoundCases
     */
    public function it_throws_route_not_found_exception(
        string $requestUrl,
        string $requestMethod
    ): void
    {
        $users = new class() {
            public function delete(): bool
            {
                return true;
            }
        };

        $this->router->post('/users', [$users::class, 'index']);
        $this->router->get('/users', ['User', 'index']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestUrl, $requestMethod);
    }

    /** @test
     * @throws RouteNotFoundException
     */
    public function it_resolves_route_from_a_closure(): void
    {
        $this->router->get('/users', fn() => [1, 2, 3]);

        $this->assertEquals(
            [1, 2, 3],
            $this->router->resolve('/users', 'get')
        );
    }

    /** @test
     * @throws RouteNotFoundException
     */
    public function it_resolves_route(): void
    {
        $users = new class() {
            public function index(): array
            {
                return [1, 2, 3];
            }

        };

        $this->router->get('/users', [$users::class, 'index']);

        $this->assertSame(
            [1, 2, 3],
            $this->router->resolve('/users', 'get')
        );
    }


}
