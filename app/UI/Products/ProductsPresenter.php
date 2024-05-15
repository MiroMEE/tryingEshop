<?php

declare(strict_types=1);

namespace App\UI\Products;

use App\Models\ProductsModel;
use Nette;
use Nette\Application\UI\Form;
final class ProductsPresenter extends Nette\Application\UI\Presenter{

    private $db;
    public function __construct(ProductsModel $db)
    {
        $this->db = $db;
    }

    public function renderDefault(){
        $this->template->items = $this->db->getProducts();
    }

    public function createComponentAddProductsForm(): Form
    {
        $form = new Form();
        $form->addText("name", "Název produktu");
        $form->addInteger("cost", "Cena produktu");
        $form->addText("description", "Podrobnosti");
        $form->addInteger("quantity","Množství");
        $form->addSubmit('Potvrdit');
        $form->onSuccess[] = [$this,'formSucceded'];
        return $form;
    }

    public function formSucceded(Form $form, $data) :void{
        $this->flashMessage('Vytvořil si úspěšně produkt');
        $this->db->createProduct($data);
    }

}