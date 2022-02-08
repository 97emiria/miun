//Activates MVC
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;
using momentet.Models;
using momentet.ModelsTwo;

namespace momentet.Controllers
{

    public class HomeController : Controller
    {

      public IActionResult Index()
        {
            ViewBag.date = DateTime.Now.ToString("yyyy-MM-dd");
            return View();
        }


        [HttpGet("/om")]
        public IActionResult About()
        {
            var JsonStr = System.IO.File.ReadAllText("data/courses.json");
            var JsonObj = JsonConvert.DeserializeObject<List<CourseModel>>(JsonStr);
                        
            return View(JsonObj);
        }


        [HttpGet("/guestbook")]
          public IActionResult GuestBook()
        {
            var JsonStrTwo = System.IO.File.ReadAllText("data/guestbook.json");
            var JsonObjTwo = JsonConvert.DeserializeObject<List<GuestBookModel>>(JsonStrTwo);    
            ViewBag.guestbook = JsonObjTwo;

            return View();
        }

        [HttpPost("/guestbook")]
        public IActionResult GuestBook(GuestBookModel model)
        {
            if (ModelState.IsValid)
            {
                // Läs in befintliga
                var JsonStr = System.IO.File.ReadAllText("data/guestbook.json");
                var JsonObj = JsonConvert.DeserializeObject<List<GuestBookModel>>(JsonStr);

                // Lägg till
                if (JsonObj != null)
                {
                    JsonObj.Add(model);
                }
                // Konvertera till JSON-sträng och spara
                System.IO.File.WriteAllText("data/guestbook.json", JsonConvert.SerializeObject(JsonObj, Formatting.Indented));
            
                ModelState.Clear();

                return RedirectToAction("GuestBook");
            }

            var JsonStrTwo = System.IO.File.ReadAllText("data/guestbook.json");
            var JsonObjTwo = JsonConvert.DeserializeObject<List<GuestBookModel>>(JsonStrTwo);    
            ViewBag.guestbook = JsonObjTwo;

            return View();
        }
    }
}