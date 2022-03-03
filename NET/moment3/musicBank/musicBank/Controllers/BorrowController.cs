#nullable disable
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using musicBank.Data;
using musicBank.Models;

namespace musicBank.Controllers
{
    public class BorrowController : Controller
    {
        private readonly MusicBankContext _context;

        public BorrowController(MusicBankContext context)
        {
            _context = context;
        }

        // GET: Borrow
        public async Task<IActionResult> Index()
        {
            var musicBankContext = _context.Borrow.Include(b => b.Album).Include(b => b.Borrower);
            return View(await musicBankContext.ToListAsync());
        }

        // GET: Borrow/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var borrow = await _context.Borrow
                .Include(b => b.Album)
                .Include(b => b.Borrower)
                .FirstOrDefaultAsync(m => m.BorrowID == id);
            if (borrow == null)
            {
                return NotFound();
            }

            return View(borrow);
        }

        // GET: Borrow/Create
        public async Task<IActionResult> Create()
        {

            //var AllAlbums = new SelectList(_context.Albums, "AlbumID", "AlbumName");
            var AllLoans =  _context.Borrow.ToList();
            var AllAlbums =  _context.Albums.ToList();
            
            var AvailableAlbums = AllAlbums;
            
            foreach (var Album in AllAlbums.ToList()) {
                
                foreach(var Loan in AllLoans.ToList()) {

                    if(Album.AlbumID == Loan.AlbumID) {
                        AvailableAlbums.Remove(Album);
                    }   
                    
                }

            }

            ViewData["AlbumID"] = new SelectList(AvailableAlbums, "AlbumID", "AlbumName");
            ViewData["BorrowerID"] = new SelectList(_context.Borrower, "BorrowerID", "NameBorrower");

            return View();
        }

        // POST: Borrow/Create
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("BorrowID,AlbumID,BorrowerID,Rented,BorrowTime")] Borrow borrow)
        {
            if (ModelState.IsValid)
            {
                _context.Add(borrow);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            ViewData["AlbumID"] = new SelectList(_context.Albums, "AlbumID", "AlbumName", borrow.AlbumID);
            ViewData["BorrowerID"] = new SelectList(_context.Borrower, "BorrowerID", "NameBorrower", borrow.BorrowerID);
            return View(borrow);
        }

        // GET: Borrow/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var borrow = await _context.Borrow.FindAsync(id);
            if (borrow == null)
            {
                return NotFound();
            }

            ViewData["AlbumID"] = new SelectList(_context.Albums, "AlbumID", "AlbumName", borrow.AlbumID);
            ViewData["BorrowerID"] = new SelectList(_context.Borrower, "BorrowerID", "NameBorrower", borrow.BorrowerID);
            return View(borrow);
        }

        // POST: Borrow/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("BorrowID,AlbumID,BorrowerID,Rented,BorrowTime")] Borrow borrow)
        {
            if (id != borrow.BorrowID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(borrow);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!BorrowExists(borrow.BorrowID))
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
            ViewData["AlbumID"] = new SelectList(_context.Albums, "AlbumID", "AlbumName", borrow.AlbumID);
            ViewData["BorrowerID"] = new SelectList(_context.Borrower, "BorrowerID", "NameBorrower", borrow.BorrowerID);
            return View(borrow);
        }

        // GET: Borrow/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var borrow = await _context.Borrow
                .Include(b => b.Album)
                .Include(b => b.Borrower)
                .FirstOrDefaultAsync(m => m.BorrowID == id);
            if (borrow == null)
            {
                return NotFound();
            }

            return View(borrow);
        }

        // POST: Borrow/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var borrow = await _context.Borrow.FindAsync(id);
            _context.Borrow.Remove(borrow);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool BorrowExists(int id)
        {
            return _context.Borrow.Any(e => e.BorrowID == id);
        }
    }
}
