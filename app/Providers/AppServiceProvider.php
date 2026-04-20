use App\Repositories\StudentRepository;
use App\Repositories\StudentRepositoryInterface;

public function register(): void
{
    $this->app->bind(
        StudentRepositoryInterface::class,
        StudentRepository::class
    );
}