#nullable disable
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using ReceProject.Data;
using ReceProject.Models;

namespace ReceProject.Controllers_Admin
{
    public class RentController : Controller
    {
        private readonly ModelsContext _context;

        public RentController(ModelsContext context)
        {
            _context = context;
        }

        // GET: Rent
        [Authorize]
        [HttpGet("/Bokningar")]
        public async Task<IActionResult> Index(string searchString)
        {

            var modelsContext = _context.Rents.Include(r => r.Room);
            _context.Rooms.ToListAsync();


            //Search
            var searchResult = from m in _context.Rents select m;
            if (!String.IsNullOrEmpty(searchString))
            {
                searchResult = searchResult.Where(s => s.Name!.Contains(searchString) || s.Phone!.Contains(searchString));

                //Return search result
                return View(await searchResult.ToListAsync());
            }


            return View(await modelsContext.ToListAsync());
        }

        // GET: Rent/Details/5
        [HttpGet("/Bokningar/Detaljer")]
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var rent = await _context.Rents
                .Include(r => r.Room)
                .FirstOrDefaultAsync(m => m.Id == id);
            if (rent == null)
            {
                return NotFound();
            }

            return View(rent);
        }

        // GET: Rent/Create
        [Authorize]
        [HttpGet("/Bokningar/Boka")]
        public IActionResult Create()
        {

            //Get the lists
            var AllRooms =  _context.Rooms.ToList();
            var AllRents =  _context.Rents.ToList();

            //Creat a new list with all rooms
            var AvailableRooms = AllRooms;

            foreach(var Rent in AllRents.ToList()) {
                foreach (var Room in AllRooms.ToList()) {

                    //Compare if room exist in database
                    if(Rent.RoomId == Room.Id) {
                        //Remove thouse rooms who is takenls
                        
                        AvailableRooms.Remove(Room);
                    }   
                }
            }

            ViewData["RoomId"] = new SelectList(AvailableRooms, "Id", "Name");
            return View();
        }

        // POST: Rent/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("Id,Name,Phone,RoomId,Note,TimeRentedSince")] Rent rent)
        {
            if (ModelState.IsValid)
            {
                _context.Add(rent);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            ViewData["RoomId"] = new SelectList(_context.Rooms, "Id", "Name", rent.RoomId);
            return View(rent);
        }

        // GET: Rent/Edit/5
        [Authorize]
        [HttpGet("/Bokningar/Ändra")]
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var rent = await _context.Rents.FindAsync(id);
            if (rent == null)
            {
                return NotFound();
            }
            //ViewData["RoomId"] = new SelectList(_context.Rooms, "Id", "Name", rent.RoomId);
            return View(rent);
        }

        // POST: Rent/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("Id,Name,Phone,RoomId,Note,TimeRentedSince")] Rent rent)
        {
            if (id != rent.Id)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(rent);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!RentExists(rent.Id))
                    {
                        return NotFound();
                    }
                    else
                    {
                        throw;
                    }
                }
                return RedirectToAction(nameof(Index));
            }
            ViewData["RoomId"] = new SelectList(_context.Rooms, "Id", "Name", rent.RoomId);
            return View(rent);
        }

        // GET: Rent/Delete/5
        [Authorize]
        [HttpGet("/Bokningar/Ta-bort")]
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var rent = await _context.Rents
                .Include(r => r.Room)
                .FirstOrDefaultAsync(m => m.Id == id);
            if (rent == null)
            {
                return NotFound();
            }

            return View(rent);
        }

        // POST: Rent/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var rent = await _context.Rents.FindAsync(id);
            _context.Rents.Remove(rent);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool RentExists(int id)
        {
            return _context.Rents.Any(e => e.Id == id);
        }
    }
}
