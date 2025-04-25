namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class RoleMiddleware
{
public function handle(Request $request, $role = null)
{
$user = Auth::user();

if (!$user || ($role && $user->role !== $role)) {
app()->route->redirect('/login');
}
}
}