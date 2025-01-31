if ($request->hasFile('photo')) {
    $photo = $request->file('photo');
    $photoName = time() . '_' . $photo->getClientOriginalName();
    $photo->move(public_path('images/products'), $photoName);

    $product->photo = $photoName; // Save only the filename in the database
}
