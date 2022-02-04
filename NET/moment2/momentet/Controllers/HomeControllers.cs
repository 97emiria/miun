//Activates MVC
using Microsoft.AspNetCore.Mvc;

namespace momentet.Controllers
{

    public class HomeController : Controller
    {
      public IActionResult Index()
        {
            return View();
        }
    }

}