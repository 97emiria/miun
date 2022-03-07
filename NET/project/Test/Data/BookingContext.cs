using Microsoft.EntityFrameworkCore;
using Test.Models;

namespace Test.Data
{
    public class BookingContext : DbContext
    {
        public BookingContext(DbContextOptions<BookingContext> options) : base(options)
        {

        }

        public DbSet<Customer> Customers { get; set; }

    }
}
