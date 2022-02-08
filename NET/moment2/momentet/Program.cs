var builder = WebApplication.CreateBuilder(args);

//Needed for MVC 
builder.Services.AddControllersWithViews();
builder.Services.AddDistributedMemoryCache();
builder.Services.AddSession();

var app = builder.Build();

//Statiska filer / wwwroot
app.UseStaticFiles();
app.UseRouting();
app.UseSession();


app.MapControllerRoute(
    name: "default",
    pattern: "{controller=Home}/{action=Index}"
);

app.Run();
