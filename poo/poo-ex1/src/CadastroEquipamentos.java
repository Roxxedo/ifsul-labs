import java.util.ArrayList;
import java.util.List;
import java.util.Objects;

public class CadastroEquipamentos {
    private List<Equipamento> equipamentos = new ArrayList<>();

    public void adicionarEquipamento(Equipamento equipamento) {
        this.equipamentos.add(equipamento);
    }

    public void listarTodos() {
        for (Equipamento equipamento : equipamentos) { // : = in
            System.out.println(equipamento.getNome());
        }
    }

    public void buscarPorCodigo(String codigo) {
        for (Equipamento equipamento : equipamentos) {
            if (Objects.equals(equipamento.getCodigoPatrimonio(), codigo)) {
                System.out.println(equipamento.getNome());
                System.out.println(equipamento.getCodigoPatrimonio());
                System.out.println(equipamento.getSetor());
                return;
            }
        }
        System.out.println("Equipamento não existe");
    }

    public void atualizarSetor(String codigo, String novoSetor) {
        for (Equipamento equipamento : equipamentos) {
            if (Objects.equals(equipamento.getCodigoPatrimonio(), codigo)) {
                equipamento.setSetor(novoSetor);
                return;
            }
        }
        System.out.println("Equipamento não existe");
    }

    public void removerPorCodigo(String codigo) {
        for (Equipamento equipamento : equipamentos) {
            if (Objects.equals(equipamento.getCodigoPatrimonio(), codigo)) {
                this.equipamentos.remove(equipamento);
                return;
            }
        }
        System.out.println("Equipamento não existe");
    }
}
