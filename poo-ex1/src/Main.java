public class Main {
    public static void main(String[] args) {
        Equipamento equipamento = new Equipamento("Nome 1", "Cod1");
        Equipamento equipamento1 = new Equipamento("Nome 2", "Cod2", "Setor");

        CadastroEquipamentos cadastroEquipamentos = new CadastroEquipamentos();

        cadastroEquipamentos.adicionarEquipamento(equipamento);
        cadastroEquipamentos.adicionarEquipamento(equipamento1);

        cadastroEquipamentos.listarTodos();

        System.out.println("= = = = =");

        cadastroEquipamentos.buscarPorCodigo("Cod1");

        System.out.println("= = = = =");

        cadastroEquipamentos.atualizarSetor("Cod2", "Setor2");

        cadastroEquipamentos.removerPorCodigo("Cod1");

        cadastroEquipamentos.listarTodos();

        System.out.println("= = = = =");

        cadastroEquipamentos.buscarPorCodigo("Cod2");
    }
}